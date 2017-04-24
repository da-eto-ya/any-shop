Feature: Product categories
  In order to use Any Shop
  As a website user
  I need to be able navigate categories

  Background:
    Given shop has category "Laptops"
    And shop has category "All-in-one"

  Scenario: View categories on homepage
    Given I am on "/"
    Then I should see "Laptops"
    And I should see "All-in-one"

  Scenario: Follow category
    Given I am on "/"
    Then I follow "Laptops"
    And the ".top-heading" element should contain "Laptops"

  Scenario: Homepage is accessible from category page
    Given I am on "/"
    And I follow "Laptops"
    Then I follow "Any Shop"
    And I should see "Welcome to Any Shop"
