Feature: Main page
  In order to use Any Shop
  As a website user
  I need to be able to open main page and see some products

  Scenario: Open Any Shop main page
    Given I have product "ThinkPad X1 Yoga" on shop
    And I am on "/"
    Then I should see "Any Shop"
