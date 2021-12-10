        </div>
        </div>
    </div>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script>
        //Menu toggle
        let toggle=document.querySelector('.toggle');
        let navigation=document.querySelector('.navigation');
        let main=document.querySelector('.main');
        toggle.onclick =function(){
            navigation.classList.toggle('active');
            main.classList.toggle('active');

        }

        ////add hover class to menu
        let list=document.querySelectorAll('.navigation li');
        function activelink()
        {
            list.forEach((iteam)=>
            iteam.classList.remove('hoverd'));

            this.classList.add('hoverd');
        }
        list.forEach((item)=>
        item.addEventListener('click',activelink));
    </script>
</body>
</html>