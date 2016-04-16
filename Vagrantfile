    # -*- mode: ruby -*-
# vi: set ft=ruby :

require 'yaml'
configValues = YAML.load_file("configs/config.yml")
vmData = configValues['vm']
mysqlData = configValues['database']
xdebug = configValues['xdebug']

Vagrant::configure("2") do |config|

 config.vm.provider :virtualbox do |vb|
    vb.customize [
      "modifyvm", :id,
      "--memory", "#{vmData['memory']}",
      "--cpus", "#{vmData['cpus']}",
      "--ioapic", "#{vmData['ioapic']}"
      ]
    end

  config.vm.box = "#{vmData['box']}"

  config.vm.hostname = "#{vmData['host_name']}"
  config.vm.synced_folder "#{vmData['synced_folder_from']}", "#{vmData['synced_folder_to']}", type: "#{vmData['synced_folder_type']}"

  config.vm.network :private_network, ip: "#{vmData['network_ip']}"

  config.vm.provision :shell, path: "shell/start.sh"
  config.vm.provision :shell, path: "shell/mysql.sh", args: ["#{mysqlData['root_password']}"]
  config.vm.provision :shell, path: "shell/nginx.sh", args: ["#{vmData['host_name']}", "#{vmData['synced_folder_to']}"]
  config.vm.provision :shell, path: "shell/xdebug.sh", args: ["#{xdebug['remote_host']}", "#{xdebug['idekey']}", "#{vmData['host_name']}"]
  config.vm.provision :shell, path: "shell/projectProperties.sh", args: ["#{mysqlData['db_name']}", "#{mysqlData['root_password']}", "#{vmData['synced_folder_to']}"]
  config.vm.provision :shell, path: "shell/project.sh", args: ["#{vmData['synced_folder_to']}"]

end
