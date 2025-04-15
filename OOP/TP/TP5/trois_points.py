class TroisPoints:
    def __init__(self, point1, point2, point3):
        self.__point1 = point1
        self.__point2 = point2
        self.__point3 = point3
    
    @property
    def point1(self):
        return self.__point1
    
    @point1.setter
    def point1(self, point):
        self.__point1 = point
    
    @property
    def point2(self):
        return self.__point2
    
    @point2.setter
    def point2(self, point):
        self.__point2 = point
    
    @property
    def point3(self):
        return self.__point3
    
    @point3.setter
    def point3(self, point):
        self.__point3 = point
    
    def sontalignes(self):
        AB = self.__point1.calculer_distance(self.__point2)
        AC = self.__point1.calculer_distance(self.__point3)
        BC = self.__point2.calculer_distance(self.__point3)
        
        return (AB - (AC + BC) == 0) or (AC - (AB + BC)) == 0 or (BC - (AB + AC)) == 0
    
    def estisocele(self):
        AB = self.__point1.calculer_distance(self.__point2)
        AC = self.__point1.calculer_distance(self.__point3)
        BC = self.__point2.calculer_distance(self.__point3)

        return AB - AC == 0 or AB - BC == 0 or AC - BC == 0
