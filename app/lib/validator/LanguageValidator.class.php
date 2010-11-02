<?php

class LanguageValidator extends AgaviValidator
{
	protected function validate()
	{
		$language = strtolower($this->getData($this->getArgument()));

		foreach ($this->getContext()->getTranslationManager()->getAvailableLocales() as $locale) {
			if ($locale['identifierData']['language'] == $language) {
				return true;
			}
		}

		$this->throwError();
		return false;
	}
}
?>