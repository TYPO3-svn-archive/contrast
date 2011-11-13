===============================================================================
Extension contrast
===============================================================================

How to use in TypoScript:

* you need to include the static TypoScript of this extension
* besides that you can integrate the behaviour to any menu by setting
  the field "module" of a page to "contrast" in the backend and use the
  following example

	[HMENU].[TMENU] {
		NO {
			allWrap = <li>|</li>

			doNotLinkIt = 1
			doNotLinkIt.if < lib.tx_contrast.isModule
			stdWrap2 < lib.tx_contrast.menuLink
		}
	}

===============================================================================
  (c) 2011 Oliver Hader <oliver.hader@typo3.org> - licensed under the GPLv2+
===============================================================================
