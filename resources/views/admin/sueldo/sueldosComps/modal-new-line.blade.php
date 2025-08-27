        <div id="modalAgregarLinea" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full">
            <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
                <div class="relative bg-white rounded-lg shadow">
                    <div class="flex justify-between items-start p-5 rounded-t border-b">
                        <h3 class="text-xl font-semibold text-gray-900 lg:text-2xl">
                            Agregar Fila a la nómina
                        </h3>
                    </div>

                    <div class="p-6 space-y-6 text-lg font-medium text-gray-800">
                        {{-- Asumimos una ruta REST para crear lineas (adaptá si tenés otra) --}}
                        <form id="formAgregarLinea" action="{{ url('/admin/nominas/'.$nomina->id.'/lineas') }}" method="POST">
                            @csrf

                            <div class="grid grid-cols-1 gap-4">
                                <div>
                                    <label class="block mb-2 text-sm font-medium text-gray-900">Tipo</label>
                                    <select name="tipo" id="tipo" class="w-full p-2 border rounded">
                                        <option value="remunerativo">Remunerativo</option>
                                        <option value="no_remunerativo">No remunerativo</option>
                                        <option value="descuento">Descuento</option>
                                    </select>
                                </div>

                                <div>
                                    <label class="block mb-2 text-sm font-medium text-gray-900">Nombre</label>
                                    <input type="text" name="nombre" id="nombre" required class="w-full p-2 border rounded" placeholder="Ej: Horas extra">
                                </div>

                                <div>
                                    <div>
                                        <label class="block mb-2 text-sm font-medium text-gray-900">Valor unitario</label>
                                        <input type="number" step="0.01" name="valor_unitario" id="valor_unitario" value="0" class="w-full p-2 border rounded">
                                    </div>
                                </div>

                                <div>
                                    <label class="block mb-2 text-sm font-medium text-gray-900">Porcentaje (solo para descuentos)</label>
                                    <input type="number" step="0.01" name="porcentaje" id="porcentaje" class="w-full p-2 border rounded" placeholder="11.00 (para 11%)">
                                    <p class="text-xs text-gray-500">Si el concepto es descuento y aplicás porcentaje, completá este campo (ej 11.00 = 11%). Si el descuento es fijo deja vacío y completa el importe arriba con cantidad/valor.</p>
                                </div>
                            </div>

                            <div class="flex justify-center mt-4 space-x-2">
                                <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700">Aceptar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>