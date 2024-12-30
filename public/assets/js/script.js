const inputCorpo = document.querySelectorAll('form.inputCorpo');
inputCorpo.forEach((item) => {
    item.style.display = 'none';
});

const btnEdit = document.querySelectorAll('span a.edit');
btnEdit.forEach((btn) => {
    btn.addEventListener('click', () => {
        const btnDataId = btn.getAttribute('data-id');
        const targetCorpo = document.querySelector(`form#inputCorpo_${btnDataId}`);
        const targetText = document.querySelector(`span#corpo_${btnDataId}`);
        
        if(targetCorpo) {
            targetCorpo.style.display = 'block';
            targetText.style.display = 'none';
        } else {
            console.log('Elemento não encontrado!');
        }
        
    });
});

const iconCheck = document.querySelectorAll('span i.fa-regular');
iconCheck.forEach((item) => {
    item.addEventListener('click', () => {
        const teste = item;
        const a = teste.getAttribute('class');
        if(a === 'fa-regular fa-square') {
            item.setAttribute('class', 'fa-solid fa-square-check');
        } else {
            item.setAttribute('class', 'fa-regular fa-square');
        }
    })
});


