
const accountType = document.getElementById('accountType');
const departmentGroup = document.querySelector('.form-group.department-group');
const departmentSelect = document.getElementById('department');

    accountType.addEventListener('change', function() {
        if(this.value === 'official'){
            departmentGroup.style.display = 'flex'; // show label + select
            departmentSelect.required = true;
        } else {
            departmentGroup.style.display = 'none'; // hide completely
            departmentSelect.required = false;
            departmentSelect.value = "";
        }
});