Feature: Comment
  In order to add a new comment
  As an authenticated user
  I need to be able to create comments

Scenario:
  Given I am on "/admin/blog/show/1"
  And I logged in as admin
  When I fill in "comment_body" with "New Comment"
  And I press "comment_save"
  Then I should see "New Comment"


