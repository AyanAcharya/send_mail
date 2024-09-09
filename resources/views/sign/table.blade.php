@include('sign/header')

    <div class="flex justify-end bg-blue-600 h-24 rounded-b-xl">
        <button class="my-8  md:my-4 bg-white px-3 rounded-lg text-blue-500 text-xs sm:text-sm md:text-base lg:text-lg xl:text-xl  2xl:text-2xl" id="messageModal">Set Reply</button>
    <button class="m-8  md:m-4 px-3 logout bg-white rounded-lg text-blue-500 text-xs sm:text-sm md:text-base lg:text-lg xl:text-xl  2xl:text-2xl">Logout</button>
    </div>
{{-- _________________________________________modal-1_______________________________________________________________________________________ --}}

<div class="fixed top-0 left-0 w-full h-full bg-black bg-opacity-50 z-50 hidden overflow-hidden" id="myModal1">
    <div class="bg-white mx-auto mt-20 p-8 border border-gray-300 w-80 max-w-md rounded-lg shadow-lg relative">
        <span class="absolute top-4 right-4 text-2xl cursor-pointer text-gray-400 hover:text-gray-700 bg-transparent" onclick="closeModal1()">&times;</span>

        <div class="mb-4">
            <input type="text" class=" message w-full px-3 py-2 border border-gray-300 rounded-lg placeholder-gray-500 focus:outline-none focus:ring focus:ring-indigo-400" placeholder="save your message">
        </div>
        
        <div class="text-center bg-white flex justify-between">
            <button class="px-4 py-2 bg-sky-500 hover:bg-sky-700  text-white rounded-lg focus:outline-none focus:ring focus:ring-indigo-400" onclick="closeModal1()">close</button>
           
        </div>
    </div>
</div>

{{-- ____________________________________________modal______________________________________________________________________________________ --}}        
<div class="fixed top-0 left-0 w-full h-full bg-black bg-opacity-50 z-50 hidden overflow-hidden" id="myModal">
    <div class="bg-white mx-auto mt-20 p-8 border border-gray-300 w-80 max-w-md rounded-lg shadow-lg relative">
        <span class="absolute top-4 right-4 text-2xl cursor-pointer text-gray-400 hover:text-gray-700 bg-transparent" onclick="closeModal()">&times;</span>

        <div class="mb-4">
            <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-lg placeholder-gray-500 focus:outline-none focus:ring focus:ring-indigo-400 Edit_message" placeholder="Edit your message">
        </div>
        
        <div class="text-center bg-white flex justify-between">
            <button class="px-4 py-2 bg-sky-500 hover:bg-sky-700  text-white rounded-lg focus:outline-none focus:ring focus:ring-indigo-400" onclick="closeModal()">close</button>
            <button type="submit" class="px-4 py-2 bg-indigo-500 hover:bg-indigo-700  text-white rounded-lg focus:outline-none focus:ring focus:ring-indigo-400 edit-save-button">Send</button>
        </div>
    </div>
</div>
{{-- ___________________________________________________ modal-2_____________________________________________________________________________ --}}   
<div class="fixed top-0 left-0 w-full h-full bg-black bg-opacity-50 z-50 overflow-auto hidden" id="myModal2">
    <div class="flex justify-center items-center h-screen bg-black bg-opacity-50 p-2" id="modalcontent-2">
        <div class="bg-slate-200 rounded-lg p-4 w-80 max-w-full sm:w-96 h-fit relative ">
            <div class="flex justify-between bg-indigo-500 p-3 rounded-l-2xl rounded-t-2xl">
                <p class="text-white bg-transparent text-xl ">Information</p>
                <span class=" text-2xl -mt-1 cursor-pointer bg-transparent text-white" onclick="closeModal2()">&times;</span>
            </div>
            <div class="bg-white mx-auto w-90 max-w-2xl relative h-4/5 max-h-96 overflow-y-auto rounded-l-2xl">
                <div id="resultDiv" class="p-2"></div>
            </div>
            <button class="mt-4 md:mt-8 px-4 py-2 bg-indigo-500 text-white rounded hover:bg-blue-600" onclick="closeModal2()">Close</button>
        </div>
    </div>
</div>



{{-- ________________________________________________________________________________________________________________________________ --}}        
        <div class="">
            
            <p class="result text-center"></p>
            <p class="message-error text-center bg-rose-400 w-full text-white" style="display: none;">Please Enter Set Reply</p>
        <div id="data_div" class=" flex justify-center  p-4 text-xs sm:text-sm md:text-base lg:text-lg xl:text-xl  2xl:text-2xl sm:w-full overflow-x-auto sm:rounded-lg">
        </div>
        <div class="flex justify-center mt-4">
        </div>
    </div>
</div>
<script src="{{asset('js/table.js')}}">
</script>

</body>
</html>
