@local_usercompletion
Feature: View user completion report
  As an admin
  I need to be able to see a user course completion report

  Background:
    Given the following "users" exist:
      | username | firstname | lastname | email                |
      | student1 | Andrew    | Blue     | student1@example.com |
    And the following "courses" exist:
      | fullname | shortname | format | enablecompletion |
      | Course 1 | C1        | topics | 1                |
      | Course 2 | C2        | topics | 1                |
    And the following "course enrolments" exist:
      | user     | course | role    |
      | student1 | C1     | student |
      | student1 | C2     | student |
    And the following course completions exist:
      | course | user     |
      | C1     | student1 |

  Scenario: An student has a completed course and a not completed course
    When I log in as "admin"
    And I navigate to "Reports > User completion report" in site administration
    Then I should see "User completion report"
    And I should see "Andrew Blue"
    And I should see "student1@example.com" in the "Andrew Blue" "table_row"
    Then I click on ".user-completion-report" "css_element" in the "Andrew Blue" "table_row"
    Then I should see "User completion report: Andrew Blue"
    Then I should not see "This user is not enrolled to any courses"
    Then I should see "Course 1"
    And I should see "Completed" in the "Course 1" "table_row"
    Then I should see "Course 2"
    And I should see "Not completed" in the "Course 2" "table_row"
    And I log out
