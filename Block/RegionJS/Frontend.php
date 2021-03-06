<?php
namespace KingPalm\B2B\Block\RegionJS;
use KingPalm\B2B\Schema as S;
use Magento\Framework\View\Element\AbstractBlock as _P;
/**
 * 2019-06-11
 * @used-by \KingPalm\B2B\Block\Registration::_toHtml()
 * @final Unable to use the PHP «final» keyword here because of the M2 code generation.
 */
class Frontend extends _P {
	/**
	 * 2019-05-30 https://github.com/magento/magento2/blob/2.3.1/app/code/Magento/Customer/view/frontend/templates/form/register.phtml
	 * @override
	 * @see _P::_toHtml()
	 * @used-by _P::toHtml():
	 *		$html = $this->_loadCache();
	 *		if ($html === false) {
	 *			if ($this->hasData('translate_inline')) {
	 *				$this->inlineTranslation->suspend($this->getData('translate_inline'));
	 *			}
	 *			$this->_beforeToHtml();
	 *			$html = $this->_toHtml();
	 *			$this->_saveCache($html);
	 *			if ($this->hasData('translate_inline')) {
	 *				$this->inlineTranslation->resume();
	 *			}
	 *		}
	 *		$html = $this->_afterToHtml($html);
	 * https://github.com/magento/magento2/blob/2.2.0/lib/internal/Magento/Framework/View/Element/AbstractBlock.php#L643-L689
	 * @return string
	 */
	final protected function _toHtml() {return df_js_x('#' . S::country(), null, 'regionUpdater', [
		'countriesWithOptionalZip' => df_directory()->getCountriesWithOptionalZip(true)
		,'defaultRegion' => ''
		,'form' => '#form-validate'
		,'optionalRegionAllowed' => true
		,'postcodeId' => '#' . S::postcode()
		,'regionInputId' => '#' . S::region()
		,'regionJson' => df_json_decode(df_directory()->getRegionJson())
		,'regionListId' => '#' . S::region_id()
	]);}
}