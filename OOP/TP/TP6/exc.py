class LengthListContituantsError(Exception):
    def __init__(self, message):
        self.__messsage = message
    
    @property
    def getMessage(self):
        return self.__messsage