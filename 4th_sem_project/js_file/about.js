
        const animatedText = document.getElementById('animatedText');
        const animatedText2 = document.getElementById('animatedText2');

        let colorIndex = 0;
 
        function changeColor() {
            const colors = ['red', 'green', 'blue', 'orange']; // Add more colors as needed
            animatedText.style.color = colors[colorIndex];
            animatedText2.style.color = colors[colorIndex];

            colorIndex = (colorIndex + 1) % colors.length;
        }
 
        // Change text color every 1000 milliseconds (1 second)
        setInterval(changeColor, 1000);


        var i = 0;
        var txt = ' ?' ;
        var speed = 50;

        function typeWriter() {
        if (i < txt.length) {
            document.getElementById("para").innerHTML += txt.charAt(i);
            i++;
            setTimeout(typeWriter, speed);
        }
        }