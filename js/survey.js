const survEl = document.querySelectorAll('.table_item');

survEl.forEach((el => {
    el.onclick = () => {
        location.href=`./sop.php?id=${el.id}`
    }
}))

