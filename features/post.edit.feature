Feature: Edit Post
  In order to edit a post
  As an authenticated user
  I need to be able to edit a post

  Scenario:
    Given I am on "/admin/blog/edit/1"
    And I logged in as admin
    When I fill in "post_title" with "Title Edited"
    And I press "post_save"
    Then I should see "Title Edited"
