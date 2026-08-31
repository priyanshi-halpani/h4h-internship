Vagrant.configure("2") do |config|
  config.vm.box = "ubuntu/jammy64"

  # Allow the website to be accessed only from this computer
  config.vm.network "forwarded_port",
    guest: 80,
    host: 8080,
    host_ip: "127.0.0.1"

  # VirtualBox settings
  config.vm.provider "virtualbox" do |vb|
    vb.memory = "2048"
    vb.cpus = 2
  end
end