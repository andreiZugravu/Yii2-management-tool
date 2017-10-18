# -*- mode: ruby -*-
# vi: set ft=ruby :

VAGRANTFILE_API_VERSION = "2"

Vagrant.configure(VAGRANTFILE_API_VERSION) do |config|
  # Use Ubuntu 16.04 Xenial Xerus 64-bit as our operating system
  config.vm.box = "ubuntu/xenial64"

  # Configurate the virtual machine to use 1GB of RAM
  config.vm.provider :virtualbox do |vb|
    vb.customize ["modifyvm", :id, "--memory", "3046"]
  end
  
  # Forward the Rails server default port to the host
  # config.vm.network :forwarded_port, guest: 3000, host: 3000
  # config.vm.network "private_network", ip: "192.168.1.206"
  
  # Add static IP
  config.vm.network "private_network", ip: "192.168.33.10"

end