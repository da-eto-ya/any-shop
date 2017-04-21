Feature: Product images
  In order to use Any Shop
  As a website user that have pretty eyes
  I need to see beautiful product images

  Scenario: Homepage contains product images
    Given shop sells "Lenovo ThinkPad X1 Yoga"
    And product "Lenovo ThinkPad X1 Yoga" has image "images/product/yoga.jpg"
    When I am on "/"
    Then the ".product-item" element should contain "yoga.jpg"
