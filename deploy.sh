#!bin/bash

loading() {
    width=120
    num_hashes=$((width - 10))
    echo -n "Loading: ["
    for ((i=0; i<=num_hashes; i++)); do
        sleep 0.1
        percent=$(( (i * 100) / num_hashes ))
        printf "\rLoading: [%-${num_hashes}s] ${percent}%%" "$(printf '#%.0s' $(seq 1 $i))"
    done
    echo "] Done!"
}

