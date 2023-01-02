wbtn=document.getElementById('white_btn');
wbtn.addEventListener('click',function(){
  document.getElementById('target').className='white';
});

bbtn=document.getElementById('black_btn');
bbtn.addEventListener('click',function(){
  document.getElementById('target').className='black';
});

function tLS(obj){
  const value = Number(obj.value.replaceAll(',', ''));
  if(isNaN(value)){
    obj.value = 0;
  }else {
    const formatValue = value.toLocaleString('ko-KR');
    obj.value = formatValue;
  }
  return;
}

function autocal(obj){
  const value_1 = Number(document.getElementById(`p_a_${obj}`).value.replaceAll(',', ''));
  const value_2 = Number(document.getElementById(`s_a_${obj}`).value.replaceAll(',', ''));
  const result = value_2 - value_1;
  const percent = result / value_1 * 100;
  if (result <= 0) {
    document.getElementById(`profit_${obj}`).value = 0;
    document.getElementById(`p_m_${obj}`).value = 0;
  }else {
    const formatValue = result.toLocaleString('ko-KR');
    document.getElementById(`profit_${obj}`).value = formatValue;
    document.getElementById(`p_m_${obj}`).value = percent;
  }
  return;
}
