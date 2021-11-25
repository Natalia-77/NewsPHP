<div class="modal" id="modalDelete">
    <div class="modal-dialog">
        <div class="modal-content shadow" id="modalDeleteContent">
            <div class="modal-header">
                   <h5 class="modal-title" id="exampleModalLabel">Ви хочете справді видалити ?</h5>
                <div class="context">
                </div>
            </div>
             <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Скасувати</button>
                     <form action="delete.php" method="POST">
                             <input type='hidden' name='id' >
                             <button type="submit"
                                     name="delete_submit"
                                     id="btnDeleteNews"
                                     class="btn btn-danger">Видалити</button>
                         </form>
                 </div>
        </div>
    </div>
</div>
