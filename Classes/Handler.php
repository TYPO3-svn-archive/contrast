<?php
/***************************************************************
 * Copyright notice
 *
 * (c) 2011 Oliver Hader <oliver.hader@typo3.org>
 * All rights reserved
 *
 * This script is part of the TYPO3 project. The TYPO3 project is
 * free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * The GNU General Public License can be found at
 * http://www.gnu.org/copyleft/gpl.html.
 *
 * This script is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 * Handles the contrast view state.
 */
class Tx_Contrast_Handler {
	const NAME = 'tx_contrast';

	/**
	 * @var array
	 */
	protected $status;

	/**
	 * @var array
	 */
	protected $arguments;

	/**
	 * Creates this object.
	 */
	public function __construct() {
		$this->fetch();
		$this->arguments = t3lib_div::_GP(self::NAME);
	}

	/**
	 * Executes the handler.
	 *
	 * @return void
	 */
	public function execute() {
		if (isset($this->arguments['toggle']) && $this->arguments['toggle']) {
			$this->toggle();
			$this->persist();
		}

		if ($this->isValidUrl()) {
			t3lib_utility_Http::redirect(
				$this->arguments['url'],
				t3lib_utility_Http::HTTP_STATUS_307
			);
		}
	}

	/**
	 * Toggles the status.
	 *
	 * @return void
	 */
	protected function toggle() {
		if (isset($this->status['enable'])) {
			$this->status['enable'] = ($this->status['enable'] ? 0 : 1);
		} else {
			$this->status['enable'] = 1;
		}
	}

	/**
	 * Fetches the status from the session data.
	 *
	 * @return void
	 */
	protected function fetch() {
		$this->status = (array) $this->getFrontend()->fe_user->getKey('ses', self::NAME);
	}

	/**
	 * Persists the status to the session data.
	 *
	 * @return void
	 */
	protected function persist() {
		$this->getFrontend()->fe_user->setKey('ses', self::NAME, $this->status);
		$this->getFrontend()->fe_user->storeSessionData();
	}

	/**
	 * Determines whether the submitted url is on local host and matches the given md5() hash.
	 *
	 * @return boolean
	 */
	protected function isValidUrl() {
		return (
			isset($this->arguments['url']) && isset($this->arguments['urlHash'])
			&& md5($this->arguments['url']) === $this->arguments['urlHash']
			&& t3lib_div::isOnCurrentHost($this->arguments['url'])
		);
	}

	/**
	 * Gets the frontend object.
	 *
	 * @return tslib_fe
	 */
	protected function getFrontend() {
		return $GLOBALS['TSFE'];
	}
}
?>