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
class Tx_Contrast_Includer {
	/**
	 * @var tslib_cObj
	 */
	public $cObj;

	/**
	 * Executes the inclusion of the stylesheet.
	 *
	 * @param string $content
	 * @param array $configuration
	 * @return string
	 */
	public function execute($content, array $configuration = NULL) {
		$configuration = (array) $configuration;

		if (isset($configuration['stylesheet'])) {
			$stylesheet = $this->getFrontend()->tmpl->getFileName($configuration['stylesheet']);
			$stylesheet = t3lib_div::resolveBackPath($stylesheet);
			$stylesheet = t3lib_div::createVersionNumberedFilename($stylesheet);

			if (!isset($configuration['media']) || empty($configuration['media'])) {
				$configuration['media'] = 'all';
			}

			$content = PHP_EOL . '<link rel="stylesheet" type="text/css" href="' .htmlspecialchars($stylesheet) .
				'" media="' . htmlspecialchars($configuration['media']) . '"' .
				$this->getEndingSlash() . '>' . PHP_EOL;
		}

		return $content;
	}

	/**
	 * Gets an ending slash if XHTML shall be rendered.
	 *
	 * @return string
	 */
	protected function getEndingSlash() {
		$result = '';

		if ($this->getFrontend()->getPageRenderer()->getRenderXhtml()) {
			$result = '/';
		}

		return $result;
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