<div>
    <label for="choferes" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Seleccione un Chofer</label>                                    
    <select id="choferes" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">                                  
        <option value="-" selected>-</option>
        @foreach ($truck_drivers as $truck_driver)
            <option value="{{$truck_driver->id}}">{{$truck_driver->name}}</option>
        @endforeach
    </select> 
</div>

<script>
    const mySelect = document.getElementById("choferes");

        mySelect.addEventListener("change", function() {
        var selectedValue = this.options[this.selectedIndex].value;
        if (selectedValue !== "-") {                              
            window.location.href = '/admin/planilla/'+selectedValue;
        }
        });
</script>