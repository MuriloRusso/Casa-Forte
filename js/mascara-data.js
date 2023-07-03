let datas = document.querySelectorAll('.date span');

for(let cont = 0; cont < datas.length; cont++){

    let dataArray = datas[cont].innerText.split('-');

    datas[cont].innerText = `${dataArray[2]}/${dataArray[1]}/${dataArray[0]}`;

}
