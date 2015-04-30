<?php
namespace TYPO3\Setup\Condition;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "TYPO3.Setup".           *
 *                                                                        *
 * It is free software; you can redistribute it and/or modify it under    *
 * the terms of the GNU Lesser General Public License, either version 3   *
 * of the License, or (at your option) any later version.                 *
 *                                                                        *
 * The TYPO3 project - inspiring people to share!                         *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;

/**
 * Condition that checks whether connection to the configured database can be established
 */
class DatabaseConnectionCondition extends AbstractCondition {

	/**
	 * Returns TRUE if the condition is satisfied, otherwise FALSE
	 *
	 * @return boolean
	 */
	public function isMet() {
		$settings = $this->configurationManager->getConfiguration(\TYPO3\Flow\Configuration\ConfigurationManager::CONFIGURATION_TYPE_SETTINGS, 'TYPO3.Flow');
		try {
			\Doctrine\DBAL\DriverManager::getConnection($settings['persistence']['backendOptions'])->connect();
		} catch (\PDOException $exception) {
			return FALSE;
		}
		return TRUE;
	}

}
