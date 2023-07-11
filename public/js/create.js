window.onload = function() {

    window.addTag = function (tag, targetId) {
        const target = document.getElementById(targetId);
        let tagContent = '';

        switch (tag) {
            case 'a':
                const destination = prompt('Enter the destination URL:');
                const content = prompt('Enter the content for the link:');
                tagContent = `<a href="${destination}">${content}</a>`;
                break;
            case 'h3':
                tagContent = '<h3></h3>';
                break;
            case 'strong':
                tagContent = '<strong></strong>';
                break;
            case 'h2':
                tagContent = '<h2></h2>';
                break;
        }

        window.insertAtCaret(targetId, tagContent);
    }

    window.addList = function(targetId) {
        const target = document.getElementById(targetId);
        const itemCount = prompt("Enter number of list items:", "1");
        let listItems = '';
    
        for (let i = 0; i < itemCount; i++) {
            listItems += '<li><strong></strong></li>\n';
        }
    
        const tagContent = `<ol>\n${listItems}</ol>\n`;
        window.insertAtCaret(targetId, tagContent);
    }
    

    window.insertAtCaret = function(areaId, text) {
        const txtarea = document.getElementById(areaId);
        const scrollPos = txtarea.scrollTop;
        let strPos = txtarea.selectionStart;
        const front = (txtarea.value).substring(0, strPos);
        const back = (txtarea.value).substring(strPos, txtarea.value.length);
        txtarea.value = front + text + back;
        strPos = strPos + text.length;
        txtarea.selectionStart = strPos;
        txtarea.selectionEnd = strPos;
        txtarea.focus();
        txtarea.scrollTop = scrollPos;
    }

    document.addEventListener('DOMContentLoaded', (event) => {
        document.querySelectorAll('.delete-form').forEach(form => {
            form.addEventListener('submit', function(event) {
                const confirmDelete = confirm('Are you sure you want to delete this post?');
                if (!confirmDelete) {
                    event.preventDefault();
                }
            });
        });
        // Similarly, attach handlers for 'editor-buttons-content2', 'editor-buttons-content3', etc.
    });
}
