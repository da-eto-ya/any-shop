Feature: Homepage
  In order to use Any Shop
  As a website user
  I need to be able to open homepage and see some products

  Scenario: Open Any Shop homepage
    Given I am on "/"
    Then I should see "Any Shop"

  Scenario: Homepage contains products
    Given I have product "ThinkPad X1 Yoga" on shop
    And I am on "/"
    Then I should see "ThinkPad X1 Yoga"
