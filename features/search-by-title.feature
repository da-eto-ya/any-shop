Feature: Search
  In order to find products in Any Shop
  As a website user
  I need to be able to search by title and find some products

  Background:
    Given shop sells "Lenovo ThinkPad X1 Yoga"
    And shop sells "Lenovo ThinkPad P40 Yoga with IPS"
    And shop sells "Apple MacBook Early 2016"

  Scenario: Search by partial name
    Given I am on "/"
    When I fill in "Query" with "Yoga"
    And press "Find"
    Then I should see "Lenovo ThinkPad X1 Yoga"
    And I should see "Lenovo ThinkPad P40 Yoga with IPS"
    But I should not see "Apple MacBook Early 2016"

  Scenario: Search by ending
    Given I am on "/"
    When I fill in "Query" with "IPS"
    And press "Find"
    Then I should see "Lenovo ThinkPad P40 Yoga with IPS"
    But I should not see "Lenovo ThinkPad X1 Yoga"
    And I should not see "Apple MacBook Early 2016"

  Scenario: Search with % char
    Given shop sells "Lenovo%Yoga"
    And I am on "/"
    When I fill in "Query" with "Lenovo%Yoga"
    And press "Find"
    Then I should see "Lenovo%"
    And I should not see "Lenovo ThinkPad X1 Yoga"

  Scenario: Search with _ char
    Given shop sells "Lenovo_IBM"
    And shop sells "Lenovo2IBM"
    And I am on "/"
    When I fill in "Query" with "Lenovo_"
    And press "Find"
    Then I should see "Lenovo_IBM"
    And I should not see "Lenovo2IBM"

  Scenario: Case insensitive search
    Given I am on "/"
    When I fill in "Query" with "yoga"
    And press "Find"
    Then I should see "Lenovo ThinkPad X1 Yoga"
    And I should see "Lenovo ThinkPad P40 Yoga with IPS"
    But I should not see "Apple MacBook Early 2016"
