    # -*- mode: ruby -*-
# vi: set ft=ruby :

Vagrant::configure("2") do |config|

 config.vm.provider :virtualbox do |vb|
    vb.customize [
      "modifyvm", :id,
      "--memory", "2048",
      "--cpus", "2",
      "--ioapic", "on"
      ]
    end

  config.vm.box = "ubuntu/trusty64"

  config.vm.hostname = "symfony.dev"
  config.vm.synced_folder "htdocs", "/var/www/symfony", type: "nfs"

  # Assign this VM to a host-only network IP, allowing you to access it
  # via the IP. Host-only networks can talk to the host machine as well as
  # any other machines on the same network, but cannot be accessed (through this
  # network interface) by any external networks.

  config.vm.network :private_network, ip: "192.168.50.11"

  config.vm.provision :shell, path: "shell/start.sh"
  config.vm.provision :shell, path: "shell/project.sh"

end