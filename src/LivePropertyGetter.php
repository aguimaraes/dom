<?php
namespace phpgt\dom;

/**
 * Calls prop_* methods to provide live properties through the
 * __get magic method.
 *
 * If the class with this trait has its own __get method, for compatibility
 * it should call the __get_live method after its own processing.
 */
trait LivePropertyGetter {

public function __get($name) {
	return self::__get_live($name);
}

private function __get_live($name) {
	$methodName = "prop_$name";
	if(method_exists($this, $methodName)) {
		return $this->$methodName();
	}
}

}#