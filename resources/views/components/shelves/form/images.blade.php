<div x-data="inputFormHandler()" class="my-2">

    <template x-for="(field, i) in fields" :key="i">
        <div class="w-full flex my-2">
            <label :for="field.id" class="border border-gray-300 rounded-md p-2 w-full bg-white cursor-pointer">
                <input type="file" accept="image/*" class="sr-only" :id="field.id" name="images[]" @change="fields[i].file = $event.target.files[0]">
                <span x-text="field.file ? field.file.name : '画像を選択'" class="text-gray-700"></span>
            </label>
            <button type="reset" @click="removeField(i)" class="p-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-500 hover:text-red-700" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                </svg>
            </button>
        </div>
    </template>


</div>

<script>
function inputFormHandler() {
  return {
    // fields: [],
    fields: [
        {file:'', id:'input-image-0'},
        // {file:'', id:'input-image-1'},
        // {file:'', id:'input-image-2'},
        // {file:'', id:'input-image-3'}
    ],
    addField() {
      const i = this.fields.length;
      this.fields.push({
        file: '',
        id: `input-image-${i}`
      });
    },
    removeField(index) {
      this.fields.splice(index, 1);
    }
  }
}
</script>
