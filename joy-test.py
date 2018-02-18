import pygame
import time
import threading

# Define some colors
BLACK    = (   0,   0,   0)
WHITE    = ( 255, 255, 255)

def epochms():
    return time.time() * 1000

# This is a simple class that will help us print to the screen
# It has nothing to do with the joysticks, just outputing the
# information.
class TextPrint:
    def __init__(self):
        self.reset()
        self.font = pygame.font.Font(None, 20)

    def print(self, screen, textString):
        textBitmap = self.font.render(textString, True, BLACK)
        screen.blit(textBitmap, [self.x, self.y])
        self.y += self.line_height
        
    def reset(self):
        self.x = 10
        self.y = 10
        self.line_height = 15
        
    def indent(self):
        self.x += 10
        
    def unindent(self):
        self.x -= 10
    

pygame.init()
 
# Set the width and height of the screen [width,height]
size = [1280, 720]
screen = pygame.display.set_mode(size)

pygame.display.set_caption("TKD Electronic Scoring System")

#Loop until the user clicks the close button.
done = False

# Used to manage how fast the screen updates
clock = pygame.time.Clock()

# Initialize the joysticks
pygame.joystick.init()
    
# Get ready to print
textPrint = TextPrint()

missingRemotes = True
numJudges = 4
numButtons = 4
numStrikes = 4
fighterScore = [0, 0]
# Joypad button indexes (red first, blue second)
strikeButtons = [[0 for button in range(2)] for fighter in range(2)]
strikeButtons = [[0, 2],[1, 3]]
# Timing - all parameters in milliseconds
multiButtonWindow = 200
judgeAgreeWindow = 1000
# Time at which each of the buttons were pressed or released
buttonPressTimes = [[0 for y in range(numButtons)] for x in range(numJudges)] # Two dimensional array of button press times
buttonReleaseTimes = [[0 for y in range(numButtons)] for x in range(numJudges)]
# Values indicate the number of strikes during the judge agreement window
# [red = 0, blue = 1][judge][strike type]
strikeNominated = [[[0 for strike in range(numStrikes)] for judge in range(numJudges)] for fighter in range(2)]

# Timers
strikeTimers = [[0 for judge in range(numJudges)] for fighter in range(2)]

# First element in return is runner up number of nominations, second element is the most nominations.
def getMostNominations(fighterIndex, strikeIndex):
    mostNominations = [0, 0]
    for j in range(numJudges):
        currentNoms = strikeNominated[fighterIndex][j][strikeIndex]
        if currentNoms > mostNominations[1]:
            mostNominations[1] = currentNoms
        elif currentNoms > mostNominations[0]:
            mostNominations[0] = currentNoms
    return mostNominations

# Judge agreement search - find another judge with the same strike within the time window
def findJudgeAgreement(fighterIndex, judgeIndex, strikeIndex):
    global fighterScore
    #print("Fighter:{} Judge:{} Strike:{}".format(fighterIndex, judgeIndex, strikeIndex))
    thisJudgeNominations = strikeNominated[fighterIndex][judgeIndex][strikeIndex]
    topTwoNominations = getMostNominations(fighterIndex, strikeIndex)
    mostNominations = topTwoNominations[1]
    nextMostNominations = topTwoNominations[0]
    
    if thisJudgeNominations < mostNominations and thisJudgeNominations >= nextMostNominations:
        fighterScore[fighterIndex] += (strikeIndex + 1)

def nominationTimeout(fighterIndex, judgeIndex, strikeIndex):
    global strikeNominated
    strikeNominated[fighterIndex][judgeIndex][strikeIndex] -= 1
        
def submitStrike(fighterIndex, judgeIndex, strikeIndex):
    global strikeNominated
    findJudgeAgreement(fighterIndex, judgeIndex, strikeIndex)
    strikeNominated[fighterIndex][judgeIndex][strikeIndex] += 1
    nominationTimer = threading.Timer(judgeAgreeWindow / 1000.0, nominationTimeout, [fighterIndex, judgeIndex, strikeIndex])
    nominationTimer.start()
    print("Fighter:{} Judge:{} Strike{}".format(fighterIndex, judgeIndex, strikeIndex))
    
# Determine individual judge strike decisions
def buttonTimeout(fighterIndex, jIndex, bIndex):
    
    # Index for red and blue fighters' buttons
    if bIndex == strikeButtons[fighterIndex][1]:
        if (epochms() - buttonPressTimes[jIndex][strikeButtons[fighterIndex][1]]) < multiButtonWindow:
            submitStrike(fighterIndex, jIndex, 3) # Button 2 double tap - 4 points
        else:
            # Not a double tap
            if (epochms() - buttonPressTimes[jIndex][strikeButtons[fighterIndex][0]]) < multiButtonWindow:
                submitStrike(fighterIndex, jIndex, 2) # Both buttons - 3 points (button 2 pushed first)
            else:
                submitStrike(fighterIndex, jIndex, 1) # Button 2 - 2 points

    elif bIndex == strikeButtons[fighterIndex][0]:
        if (epochms() - buttonPressTimes[jIndex][strikeButtons[fighterIndex][1]]) < multiButtonWindow:
            submitStrike(fighterIndex, jIndex, 2) # Both buttons - 3 points (button 1 pushed first)
        else:
            submitStrike(fighterIndex, jIndex, 0) # Button 1 - 1 point

    # Reset the timer that called this routine
    strikeTimers[fighterIndex][jIndex] = 0
        
# -------- Main Program Loop -----------
while done==False:
    # EVENT PROCESSING STEP
    for event in pygame.event.get(): # User did something
        if event.type == pygame.QUIT: # If user clicked close
            done=True # Flag that we are done so we exit this loop
        
        # Possible joystick actions: JOYAXISMOTION JOYBALLMOTION JOYBUTTONDOWN JOYBUTTONUP JOYHATMOTION
        if event.type == pygame.JOYBUTTONDOWN:
            #print("Joystick {} button {} pressed.".format(event.joy, event.button))

            # Save the last time each button was pushed
            print("Data from %d" % event.joy)
            if event.joy < numJudges and event.button < numButtons:
                buttonPressTimes[event.joy][event.button] = epochms()

                # Start the multi button wait timer if it is not already running
                fighterIndex = int(event.button in strikeButtons[1])
                judgeIndex = event.joy
                #print("FighterId: {}      JudgeId: {}".format(fighterIndex, judgeIndex))
                if strikeTimers[fighterIndex][judgeIndex] == 0:
                    strikeTimers[fighterIndex][judgeIndex] = threading.Timer(multiButtonWindow / 1000.0, buttonTimeout, [fighterIndex, judgeIndex, event.button])
                    strikeTimers[fighterIndex][judgeIndex].start()

            # Save the last time each button was released
            if event.joy < numJudges and event.button < numButtons:
                buttonReleaseTimes[event.joy][event.button] = epochms()
    
 
    # DRAWING STEP
    # First, clear the screen to white. Don't put other drawing commands
    # above this, or they will be erased with this command.
    screen.fill(WHITE)
    textPrint.reset()

    # Get count of joysticks
    joystick_count = pygame.joystick.get_count()
    missingRemotes = (joystick_count < 4)

    if missingRemotes:
        textPrint.print(screen, "Missing Remotes! Connected: {}".format(joystick_count) )
        
    textPrint.indent()
    
    # For each joystick:
    for i in range(joystick_count):
        joystick = pygame.joystick.Joystick(i)
        joystick.init()

    textPrint.print(screen, "Red Score:  {}".format(fighterScore[0]))
    textPrint.print(screen, "Blue Score: {}".format(fighterScore[1]))
    
    # ALL CODE TO DRAW SHOULD GO ABOVE THIS COMMENT
    
    # Go ahead and update the screen with what we've drawn.
    pygame.display.flip()

    # Limit to 20 frames per second
    clock.tick(20)
    
# Close the window and quit.
# If you forget this line, the program will 'hang'
# on exit if running from IDLE.
pygame.quit ()
