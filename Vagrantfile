VAGRANTFILE_API_VERSION = "2"

Vagrant.configure(VAGRANTFILE_API_VERSION) do |config|
 #The name of the box
 config.vm.box = "capturedental-app"
 #Box file from vagrantbox.es
 config.vm.box_url = "https://cloud-images.ubuntu.com/vagrant/trusty/current/trusty-server-cloudimg-amd64-vagrant-disk1.box"
 #Synced foler
 config.vm.synced_folder "./", "/var/www", create:true
 #Box ip
 config.vm.network "forwarded_port", guest: 80, host: 8080
 config.vm.network :private_network, ip: "192.168.66.66"
 #Box setup script
 config.vm.provision :shell, :path => "setup.sh"
 #Box config
 config.vm.provider "virtualbox" do |vb|
 vb.memory = 1024
 vb.cpus = 1
 end
end
