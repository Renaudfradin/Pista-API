RUN apt-get update \        
     apt-get install -y git
RUN mkdir /home/sampleTest \      
           cd /home/pista \        
           git clone https://github.com/Renaudfradin/Pista-API.git
#Set working directory
WORKDIR /home/pista