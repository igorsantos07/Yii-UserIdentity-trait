<?php
/**
 * UserIdentity represents the data needed to identify a user.
 * It implements what's needed for {@link IUserIdentity}, and original code came from {@link CBaseUserIdentity}.
 * It still misses authenticate() implementation, and you also should override getId() and getName().
 * @see CBaseUserIdentity
 */
trait UserIdentity {

	private static $ERROR_NONE             = 0;
	private static $ERROR_LOGIN_INVALID    = 1;
	private static $ERROR_UNKNOWN_IDENTITY = 100;

	public $errorCode;

	private $_state = [];

	/**
	 * Returns a value that uniquely represents the identity.
	 *
	 * @return mixed a value that uniquely represents the identity (e.g. primary key value).
	 * The default implementation simply returns {@link name}.
	 */
	public function getId() {
		return $this->getName();
	}

	/**
	 * Returns the display name for the identity (e.g. username).
	 *
	 * @return string the display name for the identity.
	 * The default implementation simply returns empty string.
	 */
	public function getName() {
		return '';
	}

	/**
	 * Returns the identity states that should be persisted.
	 * This method is required by {@link IUserIdentity}.
	 *
	 * @return array the identity states that should be persisted.
	 */
	public function getPersistentStates() {
		return $this->_state;
	}

	/**
	 * Sets an array of persistent states.
	 *
	 * @param array $states the identity states that should be persisted.
	 */
	public function setPersistentStates($states) {
		$this->_state = $states;
	}

	/**
	 * Returns a value indicating whether the identity is authenticated.
	 * This method is required by {@link IUserIdentity}.
	 *
	 * @return boolean whether the authentication is successful.
	 */
	public function getIsAuthenticated() {
		return $this->errorCode == 0;
	}

	/**
	 * Gets the persisted state by the specified name.
	 *
	 * @param string $name         the name of the state
	 * @param mixed  $defaultValue the default value to be returned if the named state does not exist
	 *
	 * @return mixed the value of the named state
	 */
	public function getState($name, $defaultValue = null) {
		return isset($this->_state[$name])? $this->_state[$name] : $defaultValue;
	}

	/**
	 * Sets the named state with a given value.
	 *
	 * @param string $name  the name of the state
	 * @param mixed  $value the value of the named state
	 */
	public function setState($name, $value) {
		$this->_state[$name] = $value;
	}

	/**
	 * Removes the specified state.
	 *
	 * @param string $name the name of the state
	 */
	public function clearState($name) {
		unset($this->_state[$name]);
	}
}