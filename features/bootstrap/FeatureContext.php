<?php

/**
 * Defines application features from the specific context.
 */
class FeatureContext extends \Behat\MinkExtension\Context\MinkContext
  implements \Behat\Behat\Context\SnippetAcceptingContext {
  /**
   * Initializes context.
   *
   * Every scenario gets its own context instance.
   * You can also pass arbitrary arguments to the
   * context constructor through behat.yml.
   */
  public function __construct() {
  }

  /**
   * @Given I logged in as admin
   */
  public function iLoggedInAsAdmin() {
    $loginPage = $this->getSession()->getPage();
    $loginPage->fillField('_username', 'mava');
    $loginPage->fillField('_password', 'pass');
    $loginPage->pressButton('_submit');
  }
}
