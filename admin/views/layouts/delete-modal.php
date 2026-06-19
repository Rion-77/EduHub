<!-- Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Delete</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p class="delete-warning-text"></p>
      </div>
      <div class="modal-footer">
        <!-- delete form -->
        <form method="post">
          <input type="hidden" class="delete-id-input" name="delete-id" value="">
          <input type="hidden" class="delete-message" name="message" value="">
          <button type="submit" class="btn btn-danger">Delete</button>
        </form>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>
<!-- /Modal -->

<!-- JavaScript for Modal -->
<script>
const dataContainer = document.querySelector(".row-data-container");
console.log(dataContainer);
dataContainer.addEventListener("click", function(e){
  const clickedBtn = e.target.closest(".delete-btn");

  if(!clickedBtn) return;

  console.log(clickedBtn);

  const parentContainer = clickedBtn.closest(".data-row-parent");
  console.log(parentContainer);

  const dataRowId = parentContainer.querySelector(".data-row-id").innerText;
  const dataRowName = parentContainer.querySelector(".data-row-name").innerText;
  console.log(dataRowId);
  console.log(dataRowName);
  
  // Change Modal text
  document.querySelector(".delete-warning-text").innerHTML = `Are you sure you want to delete <b>"${dataRowName}"</b>?`;
  document.querySelector(".delete-id-input").value = dataRowId;
  document.querySelector(".delete-message").value = `<b>"${dataRowName}"</b> has been deleted`;

});
</script>