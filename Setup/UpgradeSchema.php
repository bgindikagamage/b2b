<?php
namespace KingPalm\B2B\Setup;
use Df\Framework\DB\ColumnType as T;
use KingPalm\B2B\Schema as S;
// 2019-06-04
/** @final Unable to use the PHP «final» keyword here because of the M2 code generation. */
class UpgradeSchema extends \Df\Framework\Upgrade\Schema {
	/**
	 * 2019-06-04
	 * @override
	 * @see \Df\Framework\Upgrade::_process()
	 * @used-by \Df\Framework\Upgrade::process()
	 */
	final protected function _process() {
		if ($this->isInitial()) {
			df_dbc_c(S::enable(), T::bool(S::enable(true)));
			df_dbc_c(S::name(), S::name(true));
			df_dbc_c(S::dba(), S::dba(true));
			df_dbc_c(S::type(), S::type(true));
			df_dbc_c(S::number_of_locations(), S::number_of_locations(true));
			df_dbc_c(S::tax(), S::tax(true));
			df_dbc_c(S::phone(), S::phone(true));
			df_dbc_c(S::address(), S::address(true));
			df_dbc_c(S::city(), S::city(true));
			df_dbc_c(S::postcode(), S::postcode(true));
			df_dbc_c(S::region(), S::region(true));
			df_dbc_c(S::region_id(), S::region_id(true));
			df_dbc_c(S::country(), S::country(true));
			df_dbc_c(S::notes(), S::notes(true));
		}
		/**
		 * 2019-06-15
		 * "Implement the «Sales Agent» field for the «Customer» entity":
		 * https://github.com/kingpalm-com/b2b/issues/2
		 */
		if ($this->v('1.1.0')) {
			df_dbc_c(S::agent(), S::agent(true));
		}
		/**
		 * 2019-06-21
		 * "Transfer the company name and its address to the "address" entity":
		 * https://github.com/kingpalm-com/b2b/issues/3
		 */
		if ($this->v('1.4.0')) {
			\KingPalm\B2B\Setup\V140\MoveDataToAddress::p();
			array_map(function($c) {
				df_db_column_drop('customer_entity', $c = "kingpalm_b2b_$c");
				df_eav_setup()->removeAttribute('customer', $c);
			}, ['name', 'tax', 'phone', 'address', 'city', 'postcode', 'region', 'region_id', 'country']);
		}
	}
}