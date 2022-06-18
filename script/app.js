// INDEX PAGE

const container = document.querySelector('.container');
const otopark = ['A1','A2','A3','A4','A5','A6','A7','A8','A9','A10','A11','A12',
'B1','B2','B3','B4','B5','B6','B7','B8','B9','B10','B11','B12',
'B13','B14','B15','B16','B17','B18','B19','B20','B21','B22','B23','B24',
'C1','C2','C3','C4','C5','C6','C7','C8','C9','C10','C11','C12'];
const seats = document.querySelectorAll('.row .seat');
const info = document.querySelector('.info');
const msg = document.querySelector('.msg');

// (Araç park halinde: <span class="section-info"></span>)
console.log(info.innerHTML);

seats.forEach((seat, index) => {
    seat.id = otopark[index];
    seat.title = otopark[index];
    seat.innerText = otopark[index];
});

document.addEventListener('DOMContentLoaded', (e) => {
    let parkHalindekiAraclar = document.querySelectorAll('.park-halindeki-araclar');


    parkHalindekiAraclar.forEach((arac) => {
        
        sectionVePlakaAyarla(arac);
    });
})

function sectionVePlakaAyarla(arac) {
    document.getElementById(`${arac.children[0].innerText}`).title = `${arac.children[1].innerText}`;
    document.getElementById(`${arac.children[0].innerText}`).innerHTML = '<i class="fa-solid fa-car"></i>';
    document.getElementById(`${arac.children[0].innerText}`).className += ' occupied';
    if(arac.children[1].innerText === msg.innerHTML){
        info.innerHTML = `( Araç park halinde -> <span>${arac.children[0].innerText}</span> )`;
    }
}


container.addEventListener('click', (e) => {
    if(e.target.classList.contains('seat') &&
       !e.target.classList.contains('occupied')){
            e.target.classList.toggle('selected');

            updateSelectedCount();
       }
})


fetch('https://api.ipify.org?format=json').then((res) => {
	return res.json();
}).then((resjson) => { console.log(resjson.ip); });
