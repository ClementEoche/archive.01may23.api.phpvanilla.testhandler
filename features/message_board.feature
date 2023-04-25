Feature: Message Board

  Scenario: Create a new user
    Given I have an empty message board
    When I create a user with the username "JohnDoe"
    Then the message board should have 1 user

  Scenario: Create a new room
    Given I have an empty message board
    When I create a room with the name "General"
    Then the message board should have 1 room

  Scenario: Post a message in a room
    Given I have a message board with one user and one room
    When the user "JohnDoe" posts a message "Hello, World!" in the room "General"
    Then the room "General" should have 1 message
