function tLS(obj){
  const value = Number(obj.value.replaceAll(',', ''));
  if(isNaN(value)){
    obj.value = 0;
  }else {
    const formatValue = value.toLocaleString('ko-KR');
    obj.value = formatValue;
  }
}
