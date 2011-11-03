===============================================================================
Extension contrast
===============================================================================

How to use in TypoScript:

* you need to include the static TypoScript of this extension
* you neet to assign the hanler link at the accordant object, example

	page = PAGE
	page.999 =< lib.tx_contrast.link

How it works:

* calling the handler writes the status with the key 'tx_contrast' to the user
  session ($GLOBALS['TSFE']->fe_user->sesData
* the stylesheet file will be loaded to [PAGE].includeCSS.99999
* a TypoScript condition ensures that the stylesheet get included if required

===============================================================================
  (c) 2011 Oliver Hader <oliver.hader@typo3.org> - licensed under the GPLv2+
===============================================================================
