Feature: Blog Post List
  In order to see the posts list
  As an admin user
  I am able to visit the home page

Scenario: Visit the home page
  Given I am on "/admin/blog"
  And I logged in as admin
  Then the response should contain "Title Edited"

Scenario: Visit the post details
  Given I am on "/admin/blog"
  And I logged in as admin
  When I follow "Title Edited"
  Then I should see "Date of publication:"