Feature: Product page
  In order to be familiar with products in Any Shop
  As a website user
  I need to be able to view product page

  Scenario: Open product page with title and image
    Given shop sells "Lenovo ThinkPad X1 Yoga"
    And product "Lenovo ThinkPad X1 Yoga" has image "images/product/yoga.jpg"
    When I am on "/"
    And I follow "Lenovo ThinkPad X1 Yoga"
    Then the ".product-title" element should contain "Lenovo ThinkPad X1 Yoga"
    And the ".product-item" element should contain "Image for Lenovo ThinkPad X1 Yoga"
