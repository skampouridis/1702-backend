# -*- mode: ruby -*-
# vi: set ft=ruby :

Vagrant.configure("2") do |config|

# Adjusting datetime before provisioning.
	config.vm.provision :shell, run: "always" do |sh|
		sh.inline = "server 3.gr.pool.ntp.org; date"
	end

    config.vm.box = "scotch/box"
	config.ssh.password = "vagrant"
	config.ssh.username = "vagrant"
	config.ssh.insert_key = "true"
	
	# hostmanager plugin settings
	 config.hostmanager.enabled = true
	 config.hostmanager.manage_host = true
	 config.hostmanager.ignore_private_ip = false
	 config.hostmanager.include_offline = true
	 
	 config.hostmanager.ip_resolver = proc do |machine|
	  result = ""
	  machine.communicate.execute("ifconfig eth1") do |type, data|
		result << data if type == :stdout
	  end
	  (ip = /inet addr:(\d+\.\d+\.\d+\.\d+)/.match(result)) && ip[1]
	end
	
	
	config.vm.define 'marinetraffic.local' do |instance|

		#instance.vm.network "private_network", ip: "192.168.33.10"
		instance.vm.network "public_network", ip: "192.168.168.155"
		instance.vm.hostname = "marinetraffic.local"
		instance.hostmanager.aliases = %w(www.marinetraffic.local marinetraffic.local)
		instance.vm.provision :shell, path: "bootstrap-scotch3.0.0-php7.0.sh"
		#instance.vm.synced_folder ".", "/var/www", :mount_options => ["dmode=777", "fmode=666"]
		instance.vm.synced_folder ".", "/var/www", type:"nfs"  
		instance.vm.provider :virtualbox do |v|
		  v.gui = true
		  v.memory = 3024
		  v.cpus = 1
		end	
	end
end
