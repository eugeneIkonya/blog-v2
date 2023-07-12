document.addEventListener('DOMContentLoaded', function() {
    const hasStepsYesRadio = document.getElementById('hasStepsYes');
    const hasStepsNoRadio = document.getElementById('hasStepsNo');
    const stepsContainer = document.getElementById('stepsContainer');

    hasStepsYesRadio.addEventListener('change', function() {
        if (this.checked) {
            stepsContainer.style.display = 'block';
            addStepField();
        }
    });

    hasStepsNoRadio.addEventListener('change', function() {
        if (this.checked) {
            stepsContainer.style.display = 'none';
            stepsContainer.innerHTML = '';
        }
    });

    window.addStepField = function() {
        const stepDiv = document.createElement('div');
        stepDiv.classList.add('my-2');
    
        const titleField = document.createElement('input');
        titleField.type = 'text';
        titleField.name = 'steps[title][]';
        titleField.placeholder = 'Title';
        titleField.classList.add('form-control', 'my-2');
    
        const descField = document.createElement('textarea');
        descField.type = 'text';
        descField.name = 'steps[desc][]';
        descField.placeholder = 'Description';
        descField.classList.add('form-control', 'my-2');
    
        const imageField = document.createElement('input');
        imageField.type = 'file';
        imageField.name = 'steps[image][]';
        imageField.classList.add('form-control', 'my-2');
    
        const deleteButton = document.createElement('button');
        deleteButton.type = 'button';
        deleteButton.textContent = 'Delete this step';
        deleteButton.classList.add('btn', 'btn-danger', 'my-2');
        deleteButton.onclick = function() {
            stepsContainer.removeChild(stepDiv);
        };
    
        stepDiv.appendChild(titleField);
        stepDiv.appendChild(descField);
        stepDiv.appendChild(imageField);
        stepDiv.appendChild(deleteButton);
    
        stepsContainer.appendChild(stepDiv);
    };

    window.addStepButton = function() {
        const addStepButton = document.createElement('button');
        addStepButton.type = 'button';
        addStepButton.textContent = 'Add new step';
        addStepButton.classList.add('btn', 'btn-primary', 'my-2');
        addStepButton.onclick = function() {
            addStepField();
        };
        stepsContainer.appendChild(addStepButton);
    };

    // Initial add button
    addStepButton();
});
