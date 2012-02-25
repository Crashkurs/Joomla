function noEnglishAlpha(el){
	if(!el.value.test(/^[a-z ._-]+$/i)){
		el.errors.push("This field accepts alphabetic characters only.");
		return false;
	}else{
		return true;
	}
}