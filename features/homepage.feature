Feature: Homepage
  In order to use Any Shop
  As a website user
  I need to be able to open homepage and see some products

  Scenario: Open Any Shop homepage
    Given I am on "/"
    Then I should see "Any Shop"

  Scenario: Open when shop sells some products
    Given shop sells "Lenovo ThinkPad X1 Yoga"
    And shop sells "Apple MacBook Air 13 Early 2016"
    And I am on "/"
    Then I should see "Lenovo ThinkPad X1 Yoga"
    And I should see "Apple MacBook Air 13 Early 2016"

  Scenario: Open when shop sells no products
    Given I am on "/"
    Then the ".product-container" element should not contain "Lenovo ThinkPad X1 Yoga"
    And the ".product-container" element should not contain "product-item"
