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

  Scenario: Category contains products with images
    Given shop sells "Lenovo S200z" in "All-in-one"
    And shop sells "Lenovo ThinkPad X1 Yoga" in "Laptops"
    And product "Lenovo ThinkPad X1 Yoga" has image "images/product/yoga.jpg"
    When I am on "/"
    And I follow "Laptops"
    Then I should see "Lenovo ThinkPad X1 Yoga"
    And the ".product-list" element should contain "Image for Lenovo ThinkPad X1 Yoga"
    But I should not see "Lenovo S200z"

  Scenario: Nested categories
    Given shop has category "Lenovo" in "Laptops"
    And shop sells "ThinkPad X1 Yoga" in "Lenovo"
    And shop sells "S200z" in "All-in-one"
    When I am on "/"
    And I follow "Laptops"
    And I follow "Lenovo"
    Then I should see "ThinkPad X1 Yoga"
    But I should not see "S200z"
