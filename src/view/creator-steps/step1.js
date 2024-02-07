// Je sais pas faire ca en PHP mais j'imagine que ca doit etre possible...

document.getElementById('profilePic').addEventListener('change', function(e) {
    document.getElementById('profilePicName').textContent = e.target.files[0].name;

    const reader = new FileReader();
    reader.onload = function(e) {
        document.getElementById('profilePicPreview').src = e.target.result;
    }
    reader.readAsDataURL(e.target.files[0]);
});

function createDeleteButton(level = 1) {
    const deleteButton = document.createElement('img');
    deleteButton.src = 'view/assets/trash.svg';
    deleteButton.classList.add('delete-btn');
    deleteButton.addEventListener('click', function() {
        if (level === 1) {
            this.parentElement.parentElement.remove();
            return;
        }
        this.parentElement.parentElement.remove();
    });
    return deleteButton;
}

function addElement(containerId, inputName, placeholder) {
    const container = document.getElementById(containerId);

    const input = document.createElement('input');
    input.type = 'text';
    input.name = inputName + 'Title[]';
    console.log(' nom de l\'input : ' + input.name);
    input.placeholder = placeholder;

    const descriptionInput = document.createElement('textarea');
    descriptionInput.type = 'text';
    descriptionInput.name = inputName + 'Description[]';
    console.log(' nom de la description : ' + descriptionInput.name);
    descriptionInput.placeholder = 'Description';

    const div = document.createElement('div');
    div.classList.add('input-container');
    const div2 = document.createElement('div');
    div2.classList.add('flex-container');
    div2.appendChild(input);
    div2.appendChild(createDeleteButton(2));
    div.appendChild(div2);
    div.appendChild(descriptionInput);

    container.appendChild(div);
}

document.getElementById('addExperience').addEventListener('click', function() {
    addElement('experienceContainer', 'experience', 'Titre de l\'expérience');
});

document.getElementById('addSkill').addEventListener('click', function() {
    addElement('skillContainer', 'skill', 'Compétence');
});

document.getElementById('addEducation').addEventListener('click', function() {
    addElement('educationContainer', 'education', 'Formation');
});

document.getElementById('addInterest').addEventListener('click', function() {
    addElement('interestContainer', 'interest', 'Intérêt');
});

document.getElementById('addLanguage').addEventListener('click', function() {
    const languageContainer = document.getElementById('languageContainer');

    const languageInput = document.createElement('input');
    languageInput.type = 'text';
    languageInput.name = 'language[]';
    languageInput.placeholder = 'Langue';

    const levelSelect = document.createElement('select');
    levelSelect.name = 'languageLevel[]';
    levelSelect.innerHTML = `
        <option value="">Sélectionnez un niveau</option>
        <option value="A1">A1</option>
        <option value="A2">A2</option>
        <option value="B1">B1</option>
        <option value="B2">B2</option>
        <option value="C1">C1</option>
        <option value="C2">C2</option>
    `;

    const language = document.createElement('div');
    language.classList.add('single-language-container');

    language.appendChild(languageInput);
    language.appendChild(levelSelect);
    language.appendChild(createDeleteButton());

    languageContainer.appendChild(language);
});

function addLicense() {
    const licenseContainer = document.getElementById('licenseContainer');

    const licenseSelect = document.createElement('select');
    licenseSelect.name = 'license[]';
    const originalSelect = document.querySelector('template').content.querySelector('#permis');
    licenseSelect.innerHTML = originalSelect.innerHTML;

    const license = document.createElement('div');
    license.appendChild(licenseSelect);
    license.appendChild(createDeleteButton());

    licenseContainer.appendChild(license);
}

document.getElementById('addLicense').addEventListener('click', addLicense);