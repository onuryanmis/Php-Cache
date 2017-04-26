<?php

/**
 * 
 * @author Onur yanmış <onuryanmis@webderslerim.com>
 * @version 1.0 
 * 
 */
class Cache {
    
    private $cache_dir;

    /**
     * Cache settings
     * @param array  $config_array    
     */
    public function config($config_array)
    {
        if(!file_exists($config_array["dir"]))
        {        
            mkdir($config_array["dir"]);
        }
        $this->cache_dir = $config_array["dir"];
    }
    
    /**
     * Save the data
     * @param string $name
     * @param int $time
     */
    public function save($name,$value,$time='unlimited')
    {
        $fileName = $this->cache_dir."/".md5($name);
       
        if($this->cache_control($name,$time) == false)
        {  
            $contents = array(
                "data"=>$value,
                "time"=>$time
            );
          
            file_put_contents($fileName,serialize($contents));     
        }                    
    }
    
    /**
     * Cache Control
     * @param string $name
     * @param int $time
     * @return boolean
     */
    private function cache_control($name,$time)
    {
        $fileName = $this->cache_dir."/".md5($name);
        
        if($time == 'unlimited')
        {
           if(file_exists($fileName))
           {
            return true;
           }else{
             return false;
           }          
        }else if(is_int($time))
        {
            if(file_exists($fileName) && (time()-$time) < filemtime($fileName))
            {
                return true;
            }else{

                return false;
            }
        }
        
         
    }
    
    /**
     * Get the cache data
     * @param string $name
     * @return boolean|array
     */
    public function get($name)
    {
        
        
       if(!file_exists($this->cache_dir."/".md5($name)) && is_file($this->cache_dir."/".md5($name)))
       {
          
           return false;
       }  
       
       $str = @file_get_contents($this->cache_dir."/".md5($name));
       $cache_data = unserialize($str);
       if($this->cache_control($name, $cache_data["time"]) == true)
       {
           return $cache_data["data"];
       }else{
          return false;
       }
        
    }
    
    /**
     * Delete cache
     * @param string $name
     */
    public function delete($name)
    {
        $fileName = $this->cache_dir."/".md5($name);
        if(file_exists($fileName))
        {
            unlink($fileName);
        }
        
    }
    
    /**
     * Delete All Cache
     */
    public function delete_all()
    {
        $files = glob($this->cache_dir.'/*'); 
        foreach($files as $file){
          if(is_file($file))
          {
              unlink($file); 
          }
            
        }
    }
    

    
}
