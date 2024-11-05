if [ $(cut -d ' ' -f2 fichero.txt) == "myfpschool" ]; then
    echo "The second column contains myfpschool"
else
    echo "The second column does not contain myfpschool"
fi